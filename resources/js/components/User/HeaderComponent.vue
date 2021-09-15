<template>
<div>

  <!-- Bars/App bars の v-app-bar -->
  <v-app-bar color="primary" dark app clipped-left>
    <v-app-bar-nav-icon @click="drawer=!drawer"></v-app-bar-nav-icon>
    <v-toolbar-title>SSS</v-toolbar-title>
  </v-app-bar>

  <!-- 色付きドロワー -->
  <v-navigation-drawer
    app
    permanent
    expand-on-hover
    v-model="drawer"
    clipped
    class="deep-purple accent-1"
    dark
  >
    <v-list>
      <v-list-item
        v-for="item in items"
        :key="item.title"
        :href="item.to"
        link
      >
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
    <template v-slot:append>
      <div class="pa-2">
        <v-btn block v-on:click="logout">Logout</v-btn>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
        <input type="hidden" name="_token" :value=csrf_token>
        </form>
      </div>
    </template>
  </v-navigation-drawer>

</div>
</template>


<script>
  export default {
    data () {
      return {
        drawer: null,
        items: [
          { title: 'Dashboard', icon: 'mdi-view-dashboard', to: "/user" },
          { title: 'Account', icon: 'mdi-account-box', to: "/user/account" },
          { title: 'Admin', icon: 'mdi-gavel', to: "/user/admim" },
          { title: 'Item', icon: 'mdi-view-list', to: "/user/item" },
        ],
        csrf_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      }
    },
    methods: {
      logout() {
        document.getElementById('logout-form').submit();
      },
    },
  }
</script>
