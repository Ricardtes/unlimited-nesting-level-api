import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);


export default new Vuex.Store({
    state: {
        commentList: [],
        showSubmitBtn: true,
    },

    mutations: {
        updateCommentList(state,newValue)
        {
            state.commentList = newValue
        }
    }
})


