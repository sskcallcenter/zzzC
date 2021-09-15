<template>
<div>
  <h1>UserItem</h1>

  <router-link to="/user/item/edit">
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
    multi-sort
    class="elevation-1"
    @update:page = "getData"
  >

    <template v-slot:[`item.actions`]="{ item }">
      <router-link :to="{ name: 'user-item-edit', params: { id: item.id } }">
        <v-icon
          class="mr-2"
        >
          mdi-pencil
        </v-icon>
      </router-link>
      <v-icon
        @click="deleteConfirm(item.id)"
      >
        mdi-delete
      </v-icon>
    </template>

  </v-data-table>

  <!-- 削除確認ダイアログを追加 -->
  <v-dialog v-model="deleteDialog" persistent max-width="290">
    <v-card>
      <v-card-title class="headline">削除確認</v-card-title>
      <v-card-text>ID:{{ deleteID }}を削除してもよろしいですか？</v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="green darken-1" text @click="deleteDialog = false">キャンセル</v-btn>
        <v-btn color="green darken-1" text @click="deleteItem(deleteID)">削除</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

</div>
</template>

<script>
  export default {
    data () {
      return {
        headers: [
          { text: 'ID', value: 'id', align: 'start', sortable: true, },
          { text: 'Textbox', value: 'textbox', sortable: false, },
          { text: 'Actions', value: 'actions', align: 'end', sortable: false },
        ],
        page: 1,
        itemsPerPage: 10,
        total: 0,
        items: [],
        deleteDialog: false,	// 追加：初期値は非表示
        deleteID: null,			// 追加：削除Itemのid
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
      },

      deleteConfirm(id) {
        this.deleteDialog = true;
        this.deleteID = id;
      },
      // 削除実行
      deleteItem(id) {
        axios.delete('/ajax/user/item/' + id)
        .then( (res) => {
          this.getData(this.page);	// 成功したらページを再読み込み。
        })
        .catch( (error) => {
          console.log(error);
        })
        this.deleteDialog = false;	// 最後に削除確認ダイアログは閉じます。
      },

    }
  }
</script>
