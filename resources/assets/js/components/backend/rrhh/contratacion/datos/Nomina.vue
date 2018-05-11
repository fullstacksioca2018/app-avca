<template>
  <fieldset>
    <legend>Datos de nómina</legend>
    <div class="row">
      <div class="col-md-2">
        <label>
          <strong>Nivel:</strong>
        </label>
        <template v-if="tabulador !== ''">{{ tabulador[0].cod_nivel }}</template>
      </div>
      <div class="col-md-2">
        <label><strong>Sueldo base:</strong>
        </label>
        <template v-if="tabulador !== ''">{{ tabulador[0].sueldo_base }}</template>
      </div>
      <div class="col-md-8"></div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="banco">Banco</label>
          <select name="banco" id="banco" class="form-control" @change="obtenerCodigoBancario" v-model="banco">
            <option value="" selected="selected">Seleccione</option>
            <option :value="banco.banco" v-for="banco in bancos" :key="banco.id">{{ banco.banco }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <label for="cuenta_bancaria">Número de cuenta bancaria</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <input type="text" name="codigo_cuenta" id="codigo_cuenta" readonly :value="codigo_cuenta" size="4" style="border: none; background: transparent;">
            </span>
          </div>
          <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" class="form-control" placeholder="Número de cuenta bancaria" maxlength="20">
        </div>
      </div>
    </div>
  </fieldset>
</template>

<script>
  import {EventBus} from '../../../event-bus';

  export default {
    name: "Nomina",
    data() {
      return {
        tabulador: '',
        bancos: [],
        banco: '',
        codigo_cuenta: '',
      }
    },
    mounted() {
      this.obtenerBancos();
      EventBus.$on('tabulador-salarial', (tabulador) => {
        if (tabulador !== '') {
          this.tabulador = tabulador;
        }
      })
    },
    methods: {
      obtenerBancos() {
        axios.get('/rrhh/backend/contratacion/obtener-bancos')
          .then((response) => {
            this.bancos = response.data;
          });
      },
      obtenerCodigoBancario() {
        var that = this;
        const banco = this.banco;
        this.bancos.forEach(function (element) {
          if (banco === element.banco) {
            that.codigo_cuenta = element.codigo;
          }
        });
      },
    },
  }
</script>

<style scoped>

</style>