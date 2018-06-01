<template>
    <div class="d-flex justify-content-between">
        <div class="fecha">
            <div>
                <i class="fa fa-calendar mr-1"></i>
                <p id="diaSemana" class="diaSemana">{{ semana[diaSemana] }},</p>
                <p id="dia" class="dia">{{ dia }}</p>
                <p>de</p>
                <p id="mes" class="mes">{{ meses[mes] }}</p>
                <p>del</p>
                <p id="anio" class="anio">{{ anio }}</p>
            </div>
        </div>
        
        <div class="reloj ml-auto">
            <div class="text-right">
                <i class="fa fa-clock-o mr-1"></i>
                <p id="horas" class="horas">{{ hora }}</p>
                <p>:</p>
                <p id="minutos" class="minutos">{{ minutos }}</p>
                <p>:</p>
                <p id="segundos" class="segundos">{{ segundos }}</p>
                <p id="ampm" class="ampm">{{ ampm }}</p>            
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fecha: '',
                hora: '',
                minutos: '',
                segundos: '',
                diaSemana: '',
                dia: '',
                mes: '',
                anio: '',
                ampm: '',
                semana: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                meses: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                horaCompleta: []
            }
        },
        mounted () {
            this.obtenerHora();
        },
        methods: {
            obtenerHora() {
                this.fecha = new Date();
                this.hora = this.fecha.getHours();
                this.minutos = this.fecha.getMinutes();
                this.segundos = this.fecha.getSeconds();
                this.diaSemana = this.fecha.getDay();
                this.dia = this.fecha.getDate();
                this.mes = this.fecha.getMonth();
                this.anio = this.fecha.getFullYear();

                if(this.hora >= 12) {
                    this.hora = this.hora - 12;
                    this.ampm = "PM";
                } else {
                    this.ampm = "AM";
                }
                if(this.hora == 0){
                    this.hora = 12;
                }
                if(this.hora < 10)
                    this.hora = "0" + this.hora;
                else
                    this.hora;

                if(minutos < 10)
                    this.minutos = "0"+this.minutos;
                else
                    this.minutos;

                if(this.segundos < 10)
                    this.segundos = "0" + this.segundos;
                else
                    this.segundos;

                setInterval(this.obtenerHora, 1000);
            }
        },
    }
</script>

<style scoped>
    .reloj > div, .fecha > div {
        display: flex;        
        align-items: baseline;
        width: 100%;        
        font-size: 1rem;             
    }
    .reloj p, .fecha p {
        margin: 0;
    }
    .fecha p {
        margin-left: 0.25rem;
    }
    .reloj .cajaSegundos {
        display: inline-block;  
    }
    .reloj .ampm {        
        font-size: 0.75rem;
        margin-left: 0.25rem;
    }
</style>