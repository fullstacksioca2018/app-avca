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
                            <option :value="nomina.nomina_id" :key="nomina.id" v-for="nomina in nominas">{{
                                nomina.nombre | uppercase }}
                            </option>
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
                    <td>{{ montos.sueldo_base }}</td>
                    <td>{{ montos.prima_hijos }}</td>
                    <td>{{ montos.prima_antiguedad }}</td>
                    <td>{{ montos.prima_hogar }}</td>
                    <td>{{ montos.diurnas }}</td>
                    <td>{{ montos.nocturnas }}</td>
                    <td>{{ montos.diurnas_feriados }}</td>
                    <td>{{ montos.nocturnas_feriados }}</td>
                </tr>
                </tbody>
            </table>

            <ul class="nav nav-pills nav-justified justify-content-center mt-5">
                <li class="nav-item">
                    <span class="text-info">Aporte SSO</span> <br>
                    {{ aportesPorConcepto(16) }}
                </li>
                <li class="nav-item">
                    <span class="text-info">Aporte del seguro de paro forzoso</span> <br>
                    {{ aportesPorConcepto(17) }}
                </li>
                <li class="nav-item">
                    <span class="text-info">Aporte FAOV</span> <br>
                    {{ aportesPorConcepto(18) }}
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
                return monto;
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
                    if (voucher.concepto_id == 9) {
                        prima_hogar += voucher.monto;
                    }
                    if (voucher.concepto_id == 22) {
                        diurnas += voucher.monto;
                    }
                    if (voucher.concepto_id == 24) {
                        nocturnas += voucher.monto;
                    }
                    if (voucher.concepto_id == 26) {
                        diurnas_feriados += voucher.monto;
                    }
                    if (voucher.concepto_id == 28) {
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