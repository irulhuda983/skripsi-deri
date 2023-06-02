import Repository from './Repository';

const resource = 'user';

export default {
  getUser() {
    return Repository.get(`${resource}`);
  },
  login(payload) {
    return Repository.post(`${resource}/auth`, payload);
  },
  logout() {
    return Repository.post(`${resource}/logout`);
  },
};
