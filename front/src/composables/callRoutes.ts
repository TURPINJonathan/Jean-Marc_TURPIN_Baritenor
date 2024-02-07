import axios, { type AxiosResponse } from 'axios';

// Définition d'une interface pour le type de données que vous attendez en réponse
interface ApiResponse<T> {
  data: T;
  status: number;
  statusText: string;
}

// Définition d'un hook pour gérer les appels API
export function useApi() {
  const base_url = 'http://127.0.0.1:8001' + '/api/';

  // Fonction pour effectuer un appel GET
  async function get<T>(url: string): Promise<ApiResponse<T>  | null> {
    try {
      const response: AxiosResponse<ApiResponse<T>> = await axios.get(base_url + url);
      return response.data;
    } catch (error) {
      console.error('Error while making GET request:', error);
      return null;
    }
  }

  // Fonction pour effectuer un appel POST
  async function post<T>(url: string, data: any): Promise<ApiResponse<T>  | null> {
    try {
      const response: AxiosResponse<ApiResponse<T>> = await axios.post(base_url + url, data);
      return response.data;
    } catch (error) {
      console.error('Error while making POST request:', error);
      return null;
    }
  }

  // Retourner les fonctions pour les utiliser dans les composants
  return { get, post };
}
