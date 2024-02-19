import axios, { type AxiosResponse } from 'axios';

interface ApiResponse<T> {
  data: T;
  status: number;
  statusText: string;
}

export function useApi() {
  const base_url = 'https://localhost:8001' + '/api/';

  // To make a GET call
  async function get<T>(url: string, params?: string[]): Promise<ApiResponse<T>  | null> {
    try {
      console.info(base_url + url);
      console.log('params', params);
      const response: AxiosResponse<ApiResponse<T>> = await axios.get(base_url + url,  { params: params } );
      return response.data;
    } catch (error) {
      console.error('Error while making GET request:', error);
      return null;
    }
  }

  // To make a POST call
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
