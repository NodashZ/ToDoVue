<template>
    <div>
        <todo-message title="ToDo一覧" :content='todos.user.name + "さんのやること"'> </todo-message>
        <table class="table table-striped">
            <tr>
                <th>タイトル</th>
                <th>本文</th>
                <th>期日</th>
                <th>優先度</th>
                <th></th>
                <th></th>
            </tr>
            <tr v-for="todo in todos.data">
                <td> {{todo.title }}</td>
                <td>{{todo.content }}</td>
                <td>{{todo.deadline }}</td>
                <td>{{todo.priority }}</td>
                <td><button type="button" class="btn btn-primary" @click="editTodo(todo.id)">編集</button></td>
                <td><button type="button" class="btn btn-danger" @click="deleteTodo(todo.id)">削除</button></td>
            </tr>
        </table>
        <nav class="navbar navbar-expands-sm navbar-dark mb-2">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchTodos(pagination.prev )">前</a>
                </li>

                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#">ページ {{pagination.current_page}} /
                        {{pagination.last_page}}</a>
                </li>

                <li v-bind:class="[{disabled: !pagination.next}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchTodos(pagination.next)">次</a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
import Axios from 'axios'

export default {
    data() {
        return {
            todos: [],
            pagination: {},
        };
    },
    created() {
        this.fetchTodos("/api/todos")
    },
    methods: {
        fetchTodos(url) {
            Axios.get(url
            )
                .then(response => {
                    this.todos = response.data
                    // 直接参照するとプロパティが定義されていないと警告がでるので一旦ローカルに保存する 
                    this.pagination.current_page = this.todos.meta.current_page
                    this.pagination.last_page = this.todos.meta.last_page
                    this.pagination.next = this.todos.links.next
                    this.pagination.prev = this.todos.links.prev

                })
                .catch(error => { alert(error) })
        },
        editTodo(todoId) {
            let url = `/todo/edit/${todoId}`
            location.href = url;
        },

        deleteTodo(todoId) {
            let url = `/api/todos/${todoId}`
            if (confirm("削除してよろしいですか？")) {
                Axios.delete(url)
                    .then(Response => {
                        //リダイレクト
                        location.href = "/"
                    })
                    .catch(error => { alert(error) })
            }
        }
    }
}

</script>