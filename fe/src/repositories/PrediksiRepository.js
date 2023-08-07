import Repository from './Repository';

const resource = 'prediksi';

export default {
  getList(params = {}) {
    return Repository.get(`${resource}`, { params });
  },
  detail(id) {
    return Repository.get(`${resource}/${id}/show`);
  },
  store(payload) {
    return Repository.post(`${resource}`, payload);
  },
//   update(id, payload) {
//     return Repository.post(`${resource}/${id}/update`, payload);
//   },
  delete(id) {
    return Repository.delete(`${resource}/${id}/delete`);
  },
};