<template>
<div>
  <h1>UserItem</h1>

  <router-link to="/user/item/add">
    <v-btn>新規登録</v-btn>
  </router-link>


  <v-data-table
    :headers="headers"
    :items="items"
    :items-per-page="itemsPerPage"
    :page.sync="page"
    :server-items-length="total"
    :footer-props="{
      itemsPerPageOptions: [itemsPerPage],
      showFirstLastPage: true,
    }"
    class="elevation-1"
    @update:page = "getData"
  >

    <template v-slot:[`item.actions`]="{ item }">
      <v-icon
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>

  </v-data-table>


</div>
</template>

<script>
  export default {
    data () {
      return {
        headers: [
          { text: 'ID', value: 'id', align: 'start', sortable: false, },
          { text: 'Textbox', value: 'textbox', sortable: false, },
          { text: 'Actions', value: 'actions', align: 'end', sortable: false },
        ],
        page: 1,
        itemsPerPage: 3,
        total: 0,
        items: [],
      }
    },
    created() {
      this.getData(this.page);
    },
    methods: {
      getData(page){
        axios.get('/ajax/user/item', {
          params: {
            page: parseInt(page),
          }
        })
        .then((res) => {
          let result = res.data.result;
          this.items = result.data;
          this.total = result.total;
          this.itemsPerPage = result.per_page;
        })
        .catch((err) => {
          console.log(err);
        })
      }
    }
  }
</script>
