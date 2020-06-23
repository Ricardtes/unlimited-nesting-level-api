import ExampleComponent from "../components/CommentPage";

export default {

    methods: {

        /**
         *
         * @param action
         * @param comment
         */
        actions(action, comment){
            let $this = this;
            switch (action) {
                case 'edit':
                    this.$root.$emit('check', true, comment, 'edit');
                    break;

                case 'reply':
                    this.$root.$emit('check', true, comment, 'reply');
                    break;

                case 'delete': $this.actionDelete(comment.id);
                break;
            }
        },

        /**
         *
         * @param parentComment
         * @param comment
         * @param action
         */
        selectForAction(parentComment, comment, action){

            if(action === 'edit'){
                this.actionEdit(parentComment, comment);
            } else{
                this.actionStore(comment, parentComment.id);
            }

        },


        /**
         * get comment list
         */
        actionGetAll(){
            $.ajax('/api/v1/comments')
                .then(data => {
                    // this.comments = data.comments;
                    this.$store.commit('updateCommentList',data.comments);
                });

        },

        /**
         *
         * @param comment
         * @param pid
         */
        actionStore(comment, pid = null){

            let form = $.param({ pid: pid, comment: comment });
            let $this = this;
            $.ajax('/api/v1/comments', {
                method: 'POST',
                data: form,
                success: function (result) {
                        $this.comment = '';
                        $this.$root.$emit('check', false);
                        $this.actionGetAll();

                }
            })
        },

        /**
         *
         * @param parentComment
         * @param comment
         */
        actionEdit(parentComment, comment){

            let data =  $.param({comment:comment });
            let $this = this;
            $.ajax('/api/v1/comments/'+parentComment.id, {
                method: 'PUT',
                data: data,
                success: function (result) {
                    if (result.result) {
                        $this.$root.$emit('check', false);
                        $this.actionGetAll();
                    }

                }
            })
        },

        /**
         *
         * @param commentId
         */
        actionDelete(commentId){
            let $this = this;

            $.ajax('/api/v1/comments/'+commentId, {
                method: 'DELETE',
                success: function (result) {
                    if (result.result) {
                        $this.actionGetAll();
                    }

                }
            })
        },


    }

}


