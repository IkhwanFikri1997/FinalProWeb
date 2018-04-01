<template>
  <div class="container">
    <toast ref="toast"></toast>
      <div class="row">
        <div class="col-md-offset-4"></div>
        <div class="col-md-4">
          <h1>{{message}}</h1>
          <p>{{description}}</p>
          <form role="form" @submit.prevent="LogIn()">
            <input type="email" name="email" id="email" placeholder="Your Email" class="form-control" required v-model="user.email"> <br>
            <input type="password" name="password" id="password" placeholder="Your password" class="form-control" required v-model="user.password"><br>
            <input type="submit" value="submit" class="form-control"><br>
          </form>
        </div>
        <div class="col-md-offset-4"></div>
      </div>
  </div>
</template>

<script src="./login.component.js"></script>