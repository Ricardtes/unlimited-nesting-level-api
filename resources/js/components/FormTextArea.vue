<template>
    <div class="col-md-5 text-center mt-2 mb-2" v-if="show">
        <textarea  id="" cols="30" v-model="comment" rows="8"></textarea>

        <div class="col-md-12">
            <button class="btn btn-secondary "
                    @click="selectForAction(parentComment, comment, action)
            " :disabled='isDisabled'>Send</button>
        </div>

    </div>
</template>

<script>

    import Comments from "../helpers/Comments.mixins";

    export default {
        mixins: [Comments],
        props: {
            parentComment: Object
        },
        data () {
            return {
                show: false,
                comment: '',
                action: '',
            }
        },
        mounted() {
            let $this = this;
            this.$root.$on('check', function (boolean, comment, action) {
                $this.show = false;
                if(comment && $this.parentComment.id === comment.id){
                    $this.show = boolean;
                    $this.action = action;
                    if(action === 'edit'){
                        $this.comment = comment.comment;
                    }
                }
            })
        },
        computed: {
            isDisabled: function(){

                return !this.comment.length > 0;
            }
        }

    };
</script>
