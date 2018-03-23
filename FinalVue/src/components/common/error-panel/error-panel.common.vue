<template>
  <div class="row">
      <div class="col-md-12">
          <div class="alert alert-danger">
              <p class="text-center">
                Error! {{message}}
              </p>
              <div class="text-center" v-if="showButton">
                  <button class="btn btn-default" @click="fireEvent()">{{buttonText}}</button>
              </div>
          </div>
      </div>
  </div>
</template>

<script src="./error-panel-common.js"></script>