<template>
    <div class="container">
    <input type="email" name="email" id="email" placeholder="Your Email" class="form-control" required v-model="user.email"> <br>
    <input type="password" name="password" id="password" placeholder="Your password" class="form-control" required v-model="user.password"><br>
    <input type="submit" value="submit" class="form-control"><br>
    </div>
</template>
