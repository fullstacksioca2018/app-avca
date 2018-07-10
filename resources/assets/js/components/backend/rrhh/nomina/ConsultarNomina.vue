<template>
    <div>
        <form action="#">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="fecha">Período</label>
                        <select name="fecha" id="fecha" class="form-control" required v-model="fecha"
                                @change="obtenerVouchers">
                            <option value="" selected="selected">Seleccione</option>
                            <option value="01">Enero 2018</option>
                            <option value="02">Febrero 2018</option>
                            <option value="03">Marzo 2018</option>
                            <option value="04">Abril 2018</option>
                            <option value="05">Mayo 2018</option>
                            <option value="06">Junio 2018</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tipo_nomina">Tipo de nómina</label>
                        <select name="tipo_nomina" id="tipo_nomina" class="form-control" required v-model="tipoNomina"
                                @change="obtenerVouchers">
                            <option value="" selected="selected">Seleccione</option>
                            <option value="1">Regular</option>                            
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <div v-if="vouchers.length != 0" class="my-5">
            <table class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th rowspan="2" style="vertical-align: middle;">Sueldo base</th>
                    <th colspan="3">Primas</th>
                    <th colspan="4">Horas extras</th>
                </tr>
                <tr>
                    <td>Hijos</td>
                    <td>Antiguedad</td>
                    <td>Hogar</td>
                    <td>Diurnas</td>
                    <td>Nocturnas</td>
                    <td>Feriadas diurnas</td>
                    <td>Feriadas nocturnas</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ montos.sueldo_base.toFixed(2) }}</td>
                    <td>{{ montos.prima_hijos.toFixed(2) }}</td>
                    <td>{{ montos.prima_antiguedad.toFixed(2) }}</td>
                    <td>{{ montos.prima_hogar.toFixed(2) }}</td>
                    <td>{{ montos.diurnas.toFixed(2) }}</td>
                    <td>{{ montos.nocturnas.toFixed(2) }}</td>
                    <td>{{ montos.diurnas_feriados.toFixed(2) }}</td>
                    <td>{{ montos.nocturnas_feriados.toFixed(2) }}</td>
                </tr>
                </tbody>
            </table>

            <ul class="nav nav-pills nav-justified justify-content-center mt-5">
                <li class="nav-item">
                    <span class="text-info">Aporte SSO</span> <br>
                    {{ aportesPorConcepto(22) }}
                </li>
                <li class="nav-item">
                    <span class="text-info">Aporte del seguro de paro forzoso</span> <br>
                    {{ aportesPorConcepto(23) }}
                </li>
                <li class="nav-item">
                    <span class="text-info">Aporte FAOV</span> <br>
                    {{ aportesPorConcepto(24) }}
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ConsultarNomina",
        data() {
            return {
                vouchers: [],
                fecha: '',
                tipoNomina: '',
                nominas: []
            }
        },
        mounted() {
            this.obtenerVouchers();
            this.obtenerNominas();
        },
        methods: {
            obtenerVouchers() {
                axios.get('/rrhh/backend/nomina/obtener-vouchers', {
                    params: {
                        fecha: this.fecha,
                        nomina: this.tipoNomina
                    }
                })
                    .then(response => {
                        console.log(response.data);
                        this.vouchers = response.data;
                    })
            },
            obtenerNominas() {
                axios.get('/rrhh/backend/nomina/obtener-nominas')
                    .then(response => {
                        this.nominas = response.data;
                    })
            },
            aportesPorConcepto(concepto) {
                let monto = 0;
                this.vouchers.forEach((voucher) => {
                    if (voucher.concepto_id == concepto) {
                        monto += voucher.monto;
                    }
                });
                return monto.toFixed(2);
            }
        },
        computed: {
            montos() {
                let sueldo_base = 0;
                let prima_hijos = 0;
                let prima_antiguedad = 0;
                let prima_hogar = 0;
                let diurnas = 0;
                let nocturnas = 0;
                let diurnas_feriados = 0;
                let nocturnas_feriados = 0;

                this.vouchers.forEach((voucher) => {
                    if (voucher.concepto_id == 1) {
                        sueldo_base += voucher.monto;
                    }
                    if (voucher.concepto_id == 2) {
                        prima_antiguedad += voucher.monto;
                    }
                    if (voucher.concepto_id == 3) {
                        prima_hijos += voucher.monto;
                    }
                    if (voucher.concepto_id == 10) {
                        prima_hogar += voucher.monto;
                    }
                    if (voucher.concepto_id == 17) {
                        diurnas += voucher.monto;
                    }
                    if (voucher.concepto_id == 19) {
                        nocturnas += voucher.monto;
                    }
                    if (voucher.concepto_id == 18) {
                        diurnas_feriados += voucher.monto;
                    }
                    if (voucher.concepto_id == 20) {
                        nocturnas_feriados += voucher.monto;
                    }
                });

                return {sueldo_base, prima_hogar, prima_antiguedad, prima_hijos, diurnas_feriados, diurnas, nocturnas, nocturnas_feriados};
            }
        },
        filters: {
            moment: function (date) {
                moment.locale('es');
                return moment(date).format('MMMM YYYY');
            },
            uppercase: function (str) {
                str = str.toString();
                return str.charAt(0).toLocaleUpperCase() + str.slice(1);
            }
        }
    }
</script>

<style scoped>

</style>