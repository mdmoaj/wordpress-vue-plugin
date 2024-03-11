<template>
    <div>
      <b-button @click="showModal">Launch centered modal</b-button>
  
      <b-modal id="modal-center" v-model="isModalVisible" centered title="BootstrapVue">
        <p class="my-4">Vertically centered modal!</p>
      </b-modal>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        isModalVisible: false,
      };
    },
    methods: {
      showModal() {
        this.isModalVisible = true;
      },
    },
  };
  </script>
  