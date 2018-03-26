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
                                    <input type="text" class="form-control" placeholder="Categories Name" required v-model="category.name">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Create Categories</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <loading-panel message="Fetch users from server"
                       v-if="categoryConfig.loading && !categoryConfig.error">
        </loading-panel>
        <error-panel message="Failed fetch users from server"
                     v-if="!categoryConfig.loading && categoryConfig.error"
                     @onErrorHandled="bindUsers()">
        </error-panel>
        <div class="row" v-if="!categoryConfig.loading && !categoryConfig.error">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">ID</th>
                            <th class="text-center" style="width: 20%;">Name</th>
                            <th class="text-center" style="width: 20%;">Created At</th>
                            <th class="text-center" style="width: 20%;">Updated At</th>
                            <th class="text-center">...</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="category in categories" v-bind:key="category.id">
                            <td class="text-center">{{  category.id }}</td>
                            <td class="text-center">
                                <span v-if="!category.onedit">{{ category.name }}</span>
                                <input type="text" class="form-control" v-model="category.name" v-if="category.onedit" placeholder="category Name">
                            </td>
                            <td class="text-center">{{ category.created_at }}</td>
                            <td class="text-center">{{ category.updated_at }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-success" v-if="!category.onedit" @click="editUser(category)">Edit</button>
                                <button type="button" class="btn btn-sm btn-success" v-if="category.onedit"
                                        :disabled="category.name == ''"
                                        @click="updateUser(category)">Save</button>
                                <button type="button" class="btn btn-sm btn-danger" @click="deleteUser(category)">Del</button>
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