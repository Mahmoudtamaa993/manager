<template>
    <div class="container">
        <h3>{{project.title}}</h3>
        <p>{{project.description}}</p>
        <br/>
        <br/>
        <table class="table table-stiped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Assigned To </th>
                <th>Description </th>
                <th>Status </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="Task in project.tasks" :key="Task.id">
                <td>{{Task.title}} </td>
                <td>{{Task.user.name}} </td>
                <td>{{Task.description}} </td>
                <td style="text-align: right;"><status-badge :status="Task.statusCode"/></td>

            </tr>
        </tbody>   
        </table> 

    </div>
</template>
<script>
    import axios from 'axios';
    import StatusBadge from './../StatusBadge.vue';
    export default {
        components:{StatusBadge},
        data() {
            return {
                project: {}
            };
        },
        created() {
            axios.post('/graphql', {
                query: this.$apiQueries.singleProject,
                variables:{
                    projectIf: this.$route.params.id
                }

            }).then(res => {
                this.project = res.data.data.projects[0];
            })
        }
    }
    </script>
