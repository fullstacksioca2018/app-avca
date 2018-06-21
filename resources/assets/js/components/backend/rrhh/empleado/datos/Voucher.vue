<template>    
    <div class="col-12">
        <div class="row">
            <div class="col-md-2 offset-md-5">
                <div class="form-group">                
                    <label>Seleccione el mes</label>
                    <b-form-select v-model="mes" :options="options" class="mb-3"/>                
                </div>  
            </div>
        </div>

        <b-table striped hover :items="vouchers" :fields="fields">
            <template slot="asignaciones" slot-scope="data">
                <div v-if="data.item.tipo_concepto!== ''">
                    {{ data.item.tipo_concepto.charAt(0) !== '5' ? data.item.monto : '' }}
                </div>
                <div v-else>
                    <strong>{{ data.item.asignaciones ? data.item.asignaciones : '' }}</strong>
                </div>                
            </template>
            <template slot="deducciones" slot-scope="data">
                <div v-if="data.item.tipo_concepto !== ''">
                    {{ data.item.tipo_concepto.charAt(0) === '5' ? data.item.monto : '' }}
                </div>
                <div v-else>
                    <strong>{{ data.item.deducciones ? data.item.deducciones : '' }}</strong>
                </div> 
            </template>
        </b-table>                  

        <a :href="'/rrhh/backend/empleado/imprimir-voucher/' + empleado.empleado_id + '/' + mes" class="btn btn-primary">
            <i class="fa fa-print"></i> Imprimir
        </a>
    </div>    
</template>

<script>    

    export default {
        name: "voucher",
        props: ['empleado'],
        data() {
            return {
                vouchers: [],
                mes: '',
                options: [
                    { value:1, text:"Enero" },
                    { value:2, text:"Febrero" },
                    { value:3, text:"Marzo" },
                    { value:4, text:"Abril" },
                    { value:5, text:"Mayo" },
                    { value:6, text:"Junio" }
                ],
                fields: [
                    {
                        key: 'tipo_concepto',
                        label: 'Código'
                    },
                    {
                        key: 'descripcion',
                        label: 'Concepto'
                    },
                    {
                        key: 'porcentaje',
                        label: '% Monto'
                    },
                    {
                        key: 'asignaciones',
                        label: 'Asignaciones'
                    },
                    {
                        key: 'deducciones',
                        label: 'Deducciones'
                    },
                    {
                        key: 'total',
                        label: '--'
                    }
                ],
            }
        },
        watch: {
            'mes': function(){
                this.obtenerVouchers();
            }
        },
        mounted() {
            this.mes = new Date().getMonth() + 1
            this.obtenerVouchers();
        },
        methods: {
            obtenerVouchers() {                
                axios.get(`/rrhh/backend/empleado/vouchers/${this.empleado.empleado_id}/${this.mes}`)
                    .then(response => {
                        console.log(response.data)
                        this.vouchers = response.data
                        this.calculoVoucher();                        
                    })
                    .catch(error => {
                        console.error(error)
                    })
            },
            calculoVoucher() {
                let asignaciones = 0;
                let deducciones = 0;
                this.vouchers.forEach(voucher => {
                    console.log('Dentro del metodo ', voucher.tipo_concepto.charAt(0))
                    if (voucher.tipo_concepto.charAt(0) !== '5') {
                        asignaciones += voucher.monto;
                    } else {
                        deducciones += voucher.monto;
                    }
                });

                this.vouchers.push({
                    tipo_concepto: '',
                    descripcion: '',
                    porcentaje: 'Total',
                    asignaciones: asignaciones,
                    deducciones: deducciones
                }, {
                    tipo_concepto: '',
                    descripcion: '',
                    porcentaje: '',
                    asignaciones: '',
                    deducciones: 'Total a pagar',
                    total: asignaciones.toFixed(2) - deducciones.toFixed(2)
                })
            }
        },
    }
</script>

<style scoped>


</style>