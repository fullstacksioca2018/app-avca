/*

 <div id="app">
  <multiselect 
    v-model="value" 
    :options="options"
    :multiple="true"
    track-by="library"
    :custom-label="customLabel"
    >
  </multiselect>
  <pre>{{ value }}</pre>
</div> */

new Vue({
	components: {
  	Multiselect: window.VueMultiselect.default
	},
	data: {
  	value: { language: 'JavaScript', library: 'Vue-Multiselect' },
  	options: [
    	{	language: 'JavaScript', library: 'Vue.js' },
      { language: 'JavaScript', library: 'Vue-Multiselect' },
      { language: 'JavaScript', library: 'Vuelidate' }
    ]
	},
  methods: {
  	customLabel (option) {
      return `${option.library} - ${option.language}`
    }
  }
}).$mount('#app')