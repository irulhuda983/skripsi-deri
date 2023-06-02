import userRepository from './userRepository';
import JenisBarangRepository from './JenisBarangRepository';

const repositories = {
  user: userRepository,
  jenisBarang: JenisBarangRepository,
};

export const RepositoryFactory = {
  get: (name) => repositories[name],
};