import Repository from './Repository';

const resource = 'dash';

export default {
  getTotal(params = {}) {
    return Repository.get(`${resource}/total`, { params });
  },
  getStatistik(params = {}) {
    return Repository.get(`${resource}/statistik`, { params });
  },
  getHistory(params = {}) {
    return Repository.get(`${resource}/history`, { params });
  },
};