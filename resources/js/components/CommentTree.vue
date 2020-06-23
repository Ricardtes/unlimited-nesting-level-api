<template>
    <div class="label-wrapper mt-2 mb-2">
        <ul  v-for="child in children" v-bind:key="child.id">
            <div class="pb-2"> {{child.comment}}</div>
            <span @click="actions('edit', child)" class="btn btn-secondary">Edit</span>
            <span @click="actions('reply', child)" class="btn btn-secondary">Reply</span>
            <span @click="actions('delete', child)" class="btn btn-secondary">Delete</span>
            <form-textarea :parentComment="child"   ></form-textarea>
            <node-tree v-if="child.children && child.children.length"
                  :children="child.children" ></node-tree>
        </ul>
    </div>
</template>

<script>
    import Comments from '../helpers/Comments.mixins'
    import FormTextArea from "./FormTextArea";

    export default {
        mixins: [Comments],
        components: {
             FormTextArea
        },
        props: {
            children: Array
        }

    };
</script>
