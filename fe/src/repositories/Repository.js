import axios from 'axios';

const baseDomain = import.meta.env.VITE_APP_API_URL;
const baseURL = `${baseDomain}/api`;

const axiosInstance = axios.create({
  baseURL,
  // withCredentials: true,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    Accept: 'application/json',
  },
});

export const axiosInterceptors = (router) => {
  axiosInstance.interceptors.request.use(
    (config) => {
      const accessToken = localStorage.getItem('TOKEN');
      if (accessToken) {
        config.headers.Authorization = `Bearer ${accessToken}`;
      }
      return config;
    },
    (error) => Promise.reject(error)
  );

  axiosInstance.interceptors.response.use(
    (response) => response,
    async (error) => {
      if (error.response.status === 401 && location.pathname !== '/login') {
        localStorage.removeItem('TOKEN');
        router.push('/login');
        return;
      }

      return Promise.reject(error);
    }
  );
};

export default axiosInstance;
