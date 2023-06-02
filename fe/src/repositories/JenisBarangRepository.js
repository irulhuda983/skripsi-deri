import Repository from './Repository';

const resource = 'jenis-barang';

export default {
  get(params = {}) {
    return Repository.get(`${resource}`, { params });
  },
  detail(id) {
    return Repository.get(`${resource}/${id}/show`);
  },
  store(payload) {
    return Repository.post(`${resource}/store`, payload);
  },
  update(id, payload) {
    return Repository.post(`${resource}/${id}/update`, payload);
  },
  delete(id) {
    return Repository.delete(`${resource}/${id}/delete`);
  },
};