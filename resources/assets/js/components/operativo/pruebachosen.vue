<template>
    <div id='search-results'>
  Vue model value
  <br> {{ cities }}
  <hr> Select value:
  <select class="cs-select" v-chosen='cities' v-model='cities'>
    <option value="Toronto">Toronto</option>
    <option value="Orleans">Orleans</option>
  </select>
</div>

</template>

<script>
Vue.directive('chosen', {
  twoWay: true, // note the two-way binding
  bind: function(el, binding, vnode) {

    Vue.nextTick(function() {
      $(el).chosen().on('change', function(e, params) {
        alert(el.value);
      }.bind(binding));
    });
  },
  update: function(el) {
    // note that we have to notify chosen about update
    // $(el).trigger("chosen:updated");
  }
});

var vm = new Vue({
  data: {
    cities: ''
  }
}).$mount("#search-results");

</script>
<script src="../../../../../public/online/plugins/lib/chosen/chosen.jquery.js" type="text/javascript" charset="utf-8"></script>
<style src="../../../../../public/online/plugins/lib/chosen/chosen.css"></style>
<style src="../../../../../public/online/plugins/lib/chosen/bootstrap-chosen.css"></style>
