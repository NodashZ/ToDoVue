<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <todo-message title="ToDo編集フォーム" :content='todo.user_name + "さんのやること"'> </todo-message>
            <form @submit.prevent="saveTodo">

                <input name="id" :value="todo.id" type="hidden">

                <div class="form-group">
                    <label for="title">
                        タイトル
                    </label>
                    <input id="title" name="title" class="form-control" v-model="todo.title" type="text" required>
                    
                </div>
                <div class="form-group">
                    <label for="content">
                        内容
                    </label>
                    <textarea id="content" name="content" class="form-control" rows="4" v-model="todo.content" required></textarea>
                    
                </div>
                <div class="form-group">
                    <label for="content">
                        期日
                    </label>
                    <input type="date" class="form-control" id="deadline" name="deadline" v-model="todo.deadline">
                   
                </div>
                <div class="form-group">
                    <label for="content">
                        優先度
                    </label>
                    <select class="form-control" id="priority" name="priority" v-model="todo.priority">
                        <option > </option>
                        <option >高</option>
                        <option >中</option>
                        <option >低</option>
                        <option >完</option>
                    </select>
                    
                </div>
                <div class="mt-5">
                    <a class="btn btn-secondary" href="/">
                        キャンセル
                    </a>
                    <button type="submit" class="btn btn-primary">
                        更新する
                    </button>
                </div>

            </form>
        </div>
    </div>
</template>
<script>
import Axios from 'axios'

export default {
    data() {
        return {
            todoId: 0,
            todo: {},
        };
    },
    created() {
        this.todoId = location.pathname.substring(location.pathname.lastIndexOf('/') + 1)
        let url = `/api/todos/${this.todoId}`
        this.fetchTodo(url)
    },
    methods: {
        fetchTodo(url) {
            Axios.get(url)
                .then(response => {
                    this.todo = response.data.data
                })
                .catch(error => { alert(error) })
        },

        saveTodo() {
            let url = `/api/todos/${this.todoId}`
            if (confirm("更新してよろしいですか？")) {
                Axios.put(url, {
                    todo: this.todo,
                   })
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