Nova.booting((Vue, router, store) => {
  Vue.component('index-laravel-nova-markdown', require('./components/IndexField'))
  Vue.component('detail-laravel-nova-markdown', require('./components/DetailField'))
  Vue.component('form-laravel-nova-markdown', require('./components/FormField'))
})
