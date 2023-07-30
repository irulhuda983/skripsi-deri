import userRepository from './userRepository';
import JenisBarangRepository from './JenisBarangRepository';
import StockBarangRepository from './StockBarangRepository';
import PrediksiRepository from './PrediksiRepository';

const repositories = {
  user: userRepository,
  jenisBarang: JenisBarangRepository,
  stockBarang: StockBarangRepository,
  prediksi: PrediksiRepository,
};

export const RepositoryFactory = {
  get: (name) => repositories[name],
};