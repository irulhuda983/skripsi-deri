import Repository from './Repository';

const resource = 'stock-barang';

export default {
  get(params = {}) {
    return Repository.get(`${resource}`, { params });
  },
  detail(id) {
    return Repository.get(`${resource}/${id}/show`);
  },
  store(payload) {
    return Repository.post(`${resource}`, payload);
  },
  uploadCsv(payload) {
    return Repository.post(`${resource}/upload-csv`, payload, {
      headers: {
          "Content-Type": "multipart/form-data"
      }
    });
  },
  update(id, payload) {
    return Repository.post(`${resource}/${id}/update`, payload);
  },
  delete(id) {
    return Repository.delete(`${resource}/${id}/delete`);
  },
};