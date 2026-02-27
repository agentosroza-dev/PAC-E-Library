import { createStore } from 'vuex';
import axios from 'axios';
import { getVerifyAccount } from '@/functions/api/auth'; // Adjust import path

// Create Vuex store
const store = createStore({
    state: {
        user: null,
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setUserPhoto(state, photo) {
            if (state.user) {
                state.user.photo = photo;
            }
        },
    },
    actions: {
        async verifyAccount({ commit }) {
            try {
                const token = localStorage.getItem('token');
                if (!token) {
                    localStorage.removeItem('token');
                    return commit('setUser', null);
                }
                axios.defaults.headers.common['Authorization'] = token ? `Bearer ${token}` : '';
                const response = await getVerifyAccount(token);
                return commit('setUser', response.data.user);
            } catch (error) {
                console.log(error);
                localStorage.removeItem('token');
                commit('setUser', null);
            }
        }
    },
    getters: {
        isAuthenticated: (state) => !!state.user,
        getUser: (state) => state.user,
        getUserName: (state) => state.user?.name || 'Guest',
        getUserEmail: (state) => state.user?.email || '',
        getUserPhoto: (state) => state.user?.photo || '/default-avatar.png',
    }
});

export default store;
