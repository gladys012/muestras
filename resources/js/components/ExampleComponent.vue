<template>
  <div class="container">
    <!--h3>Vue datatables example</h3>
    Filter by anything: <input v-model="search">
    <hr>
    <data-table :users="filteredUsers"></data-table-->
  </div>

</template>
     /*
<script>
import DataTable from './DataTable.vue'

export default {
  components: {
    DataTable
  },
  data() {
    return {
      users: [],
      search: '',    
    }
  },
  computed: {
    filteredUsers: function(){
      let self = this;
      let search = self.search.toLowerCase();
      return self.users.filter(function(comments){
        return comments.usuario.toLowerCase().indexOf(search) !== -1 ||
              comments.password.toLowerCase().indexOf(search) !== -1 ||
              comments.idrol.toLowerCase().indexOf(search) !== -1 ||
              comments.estado.toLowerCase().indexOf(search) !== -1 ||
              comments.remember_token.toLowerCase().indexOf(search) !== -1
        })
    }
  },
  mounted(){
    let vm = this;
    $.ajax({
      url: '/api/users',
      success(res){
        vm.users = res;
        console.log(vm.users);
        console.log('user...*');
      }
    })
  }
}
</script>
*/