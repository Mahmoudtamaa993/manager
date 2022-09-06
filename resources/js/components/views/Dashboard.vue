<template>
    <div class="container">
        <div class="card-columns">
            <project-card 
                v-for="project in projects" 
                :project="project" 
                :key="project.id"></project-card>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import ProjectCard from './../ProjectCard.vue';
export default {
    components: {ProjectCard},
    data() { // define the data property
        return {
            projects: []
        };
    },
    created() {
        axios.post('/graphql', {    //does't matter what type of http request we make becouse we have not restful API
            query: this.$apiQueries.dashboard   // make our request
        }).then(res => { // if we get data back from the server then we can have data property call projects should the same response from the server
            this.projects = res.data.data.projects;
        });
    }
}
</script>