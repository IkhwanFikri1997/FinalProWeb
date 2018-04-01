<template>
    <div class="container">
        <toast ref="toast"></toast>
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>{{ message }}</h1>
                            <p>{{ description }}</p>
                        </div>
                        <div class="col-md-4 col-md-push-2">
                            <p class="text-center">
                                <strong>Create New User</strong>
                            </p>
                            <form role="form" @submit.prevent="storeUser()">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="items Name" required v-model="item.name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="items Description" required v-model="item.desc">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" v-model="item.category_id" placeholder="Category">
                                      <option disabled value="">Pick a category</option>
                                      <option v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="items Price" required v-model="item.price">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="items Stock" required v-model="item.stock">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Create items</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <loading-panel message="Fetch users from server"
                       v-if="itemConfig.loading && !itemConfig.error">
        </loading-panel>
        <error-panel message="Failed fetch users from server"
                     v-if="!itemConfig.loading && itemConfig.error"
                     @onErrorHandled="bindUsers()">
        </error-panel>
        <div class="row" v-if="!itemConfig.loading && !itemConfig.error">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">ID</th>
                            <th class="text-center" style="width: 20%;">Name</th>
                            <th class="text-center" style="width: 20%;">Description</th>
                            <th class="text-center" style="width: 20%;">Category</th>
                            <th class="text-center" style="width: 20%;">Price</th>
                            <th class="text-center" style="width: 20%;">Stock</th>
                            <th class="text-center" style="width: 20%;">Created At</th>
                            <th class="text-center" style="width: 20%;">Updated At</th>
                            <th class="text-center">...</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in items" v-bind:key="item.id">
                            <td class="text-center">{{ item.id }}</td>
                            <td class="text-center">
                                <span v-if="!item.onedit">{{ item.name }}</span>
                                <input type="text" class="form-control" v-model="item.name" v-if="item.onedit" placeholder="item Name">
                            </td>
                            <td class="text-center">
                                <span v-if="!item.onedit">{{ item.desc }}</span>
                                <input type="text" class="form-control" v-model="item.desc" v-if="item.onedit" placeholder="item description">
                            </td>
                            <td class="text-center">
                                <span v-if="!item.onedit">{{ item.category_id }}</span>
                                <select class="form-control" v-model="item.category_id" v-if="item.onedit">
                                  <option disabled value="">choose category</option>
                                  <option v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <span v-if="!item.onedit">{{ item.price }}</span>
                                <input type="text" class="form-control" v-model="item.price" v-if="item.onedit" placeholder="item description">
                            </td>
                            <td class="text-center">
                                <span v-if="!item.onedit">{{ item.stock }}</span>
                                <input type="text" class="form-control" v-model="item.stock" v-if="item.onedit" placeholder="item description">
                            </td>
                            <td class="text-center">{{ item.created_at }}</td>
                            <td class="text-center">{{ item.updated_at }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-success" v-if="!item.onedit" @click="editUser(item)">Edit</button>
                                <button type="button" class="btn btn-sm btn-success" v-if="item.onedit"
                                        :disabled="item.name == ''"
                                        @click="updateUser(item)">Save</button>
                                <button type="button" class="btn btn-sm btn-danger" @click="deleteUser(item)">Del</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="./test.component.js"></script>