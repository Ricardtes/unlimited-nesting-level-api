<template>
    <div class="container mt-5">
        <form @submit.prevent >
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div
                        v-for="comment in this.$store.state.commentList"
                    >
                        <div class="label-wrapper">
                            <div class="pb-2">{{comment.comment}}</div>

                            <span @click="actions('edit', comment)" class="btn btn-secondary">Edit</span>
                            <span @click="actions('reply', comment)" class="btn btn-secondary">Reply</span>
                            <span @click="actions('delete', comment)" class="btn btn-secondary">Delete</span>
                            <form-textarea :parentComment="comment"   ></form-textarea>
                        </div>

                        <node-tree v-if="comment.children && comment.children.length" :children="comment.children" ></node-tree>
                    </div>

                    <div class="col-md-8 text-center">
                        <textarea v-model="comment" name="comment" class="form-control" id="" cols="30" rows="3">
                        </textarea>

                        <button   class="btn btn-secondary" :disabled='isDisabled'
                                  @click="actionStore(comment)" >Send</button>
                    </div>



                </div>
            </div>
        </form>
    </div>
</template>
<script>
     import Comments from '../helpers/Comments.mixins'
     import NodeTree from "./CommentTree";
     import FormTextArea from "./FormTextArea";

    export default {
           mixins: [Comments],
        components: {
            NodeTree, FormTextArea
        },
        data () {
            return {
                component: FormTextArea,
                tree: [],
                comment: '',
            }
        },
        beforeMount() {
            this.actionGetAll();
        },
        computed: {
            /**
             *
             * @returns {boolean}
             */
            isDisabled: function(){

                return !this.comment.length > 0;
            }
        }
    }
</script>
