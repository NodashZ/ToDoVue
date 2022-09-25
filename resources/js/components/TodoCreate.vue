<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <todo-message title="ToDo投稿フォーム" content="やること登録"> </todo-message>
            <form @submit.prevent="saveTodo">
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
                    <textarea id="content" name="content" class="form-control" rows="4" v-model="todo.content" ></textarea>
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
                        <option value=" "> </option>
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
            todo: {},
        };
    },
    created() {
        
    },
    methods: {
        saveTodo() {
            let url = `/api/todos`
            if (confirm("送信してよろしいですか？")) {
                Axios.post(url, {
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