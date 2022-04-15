import axios from 'axios'
import router from "../router";

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: {},
        isLoggedIn: !!localStorage.getItem('token'),
        token: localStorage.getItem('token')
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value;
        },
        SET_USER(state, {data}) {
            state.user = data;
        },
        SET_TOKEN(state, {data}) {
            let token = data.access_token;
            state.token = token;
            state.isLoggedIn = true;
            localStorage.setItem('token', token)
            localStorage.setItem('reload', 1)
        },
        REMOVE_TOKEN(state) {
            state.isLoggedIn = false;
            state.token = localStorage.removeItem('token')
        }
    },
    actions: {
        login({commit}, value) {
            commit('SET_TOKEN', value);
            //axios config
            axios.defaults.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
            return axios.post('/api/v1/auth/me')
                .then(({data}) => {
                    console.log(data.data)
                    commit('SET_USER', data);
                    commit('SET_AUTHENTICATED', true);
                    router.push({name: 'dashboard'})
                }).catch(({response: {data}}) => {
                    commit('SET_USER', {});
                    commit('SET_AUTHENTICATED', false);
                })
        },
        logout({commit}) {
            commit('SET_USER', {});
            commit('REMOVE_TOKEN');
            commit('SET_AUTHENTICATED', false);
        }
    }
}
