import userRepository from './userRepository';
import DashboardRepository from './DashboardRepository';
import JenisBarangRepository from './JenisBarangRepository';
import StockBarangRepository from './StockBarangRepository';
import PrediksiRepository from './PrediksiRepository';

const repositories = {
  user: userRepository,
  jenisBarang: JenisBarangRepository,
  stockBarang: StockBarangRepository,
  prediksi: PrediksiRepository,
  dashboard: DashboardRepository,
};

export const RepositoryFactory = {
  get: (name) => repositories[name],
};