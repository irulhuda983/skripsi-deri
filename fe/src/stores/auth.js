import { ref, computed } from 'vue';
import { defineStore } from 'pinia';
import { RepositoryFactory } from '@/repositories/RepositoryFactory';

const userRepository = RepositoryFactory.get('user');

export const useAuthStore = defineStore('auth', () => {
  const user = ref(localStorage.getItem('USER') || null);
  const token = ref(localStorage.getItem('TOKEN') || null);
//   const roles = ref(localStorage.getItem('ROLES') || null);

  const isAuthenticated = computed(() => !!(user.value && token.value));

  const setUser = (data) => {
    user.value = data;
    !user.value
      ? localStorage.removeItem('USER')
      : localStorage.setItem('USER', JSON.stringify(data));
  };

  const setToken = (data) => {
    token.value = data;
    !token.value ? localStorage.removeItem('TOKEN') : localStorage.setItem('TOKEN', data);
  };

//   const setRoles = (data) => {
//     roles.value = data;
//     !roles.value
//       ? localStorage.removeItem('ROLES')
//       : localStorage.setItem('ROLES', JSON.stringify(data));
//   };

  const getUser = async () => {
    const token = localStorage.getItem('TOKEN');
    if (!token) return;

    try {
      const { data } = await userRepository.getUser();
      setUser(data.data);
    //   setRoles(data.data.roles);
    } catch (error) {
      setToken(null);
      setUser(null);
    //   setRoles(null);
    }
  };

  const login = async (payload) => {
    try {
      const { data } = await userRepository.login(payload);
      await Promise.all([setToken(data.token), getUser()]);
    } catch (error) {
      setToken(null);
      setUser(null);
    //   setRoles(null);

      if (error.response) {
        throw error.response;
      }
      throw error;
    }
  };

  const logout = () => {
    setToken(null);
    setUser(null);
    // setRoles(null);
  };

  return { user, token, isAuthenticated, getUser, login, logout };
});
