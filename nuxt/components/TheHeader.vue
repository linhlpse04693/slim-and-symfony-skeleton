<template>
  <nav class="bg-white rounded shadow p-4">
    <div class="flex flex-wrap justify-end items-center">
      <div class="relative mr-4">
        <fa-icon :icon="['far', 'bell']" class="text-2xl" />
        <div
          class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-sm flex justify-center items-center">
          1
        </div>
      </div>

      <div class="flex flex-col items-end mr-4">
        <h5 class="font-bold">
          {{ user.name }}
        </h5>

        <p class="text-gray-500">
          admin
        </p>
      </div>
      <div class="w-10 h-10 relative">
        <img
          :src="user.avatar"
          class="w-full h-full object-cover rounded-full"
          @click="showMenu = !showMenu"
        >
        <div v-if="showMenu" class="absolute top-full right-0 w-auto">
          <div class="rounded mt-4 bg-white border flex flex-col">
            <nuxt-link to="/profile" class="px-4 py-2 flex items-center">
              <fa-icon :icon="['fas', 'user-alt']" class="mr-2"></fa-icon> Profile
            </nuxt-link>
            <div class="px-4 py-2 flex items-center cursor-pointer" @click="logout">
              <fa-icon :icon="['fas', 'sign-out-alt']" class="mr-2"></fa-icon> Logout
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import {mapState} from 'vuex';

export default {
  data: () => ({
    showMenu: false,
  }),
  computed: {
    ...mapState('auth',{
      user: state => state.user,
    }),
  },
  methods: {
    async logout() {
      await this.$store.dispatch('auth/logout');
      await this.$router.push('/login');
    }
  }
}
</script>
