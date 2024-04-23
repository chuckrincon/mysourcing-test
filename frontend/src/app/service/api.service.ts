import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

interface User {
  id: number;
  name: string;
}

@Injectable({
  providedIn: 'root'
})

export class ApiService {
  apiUrl = 'http://localhost:8000';

  constructor(private http: HttpClient) { }

  getAllUsers(): Observable<User[]> {
    return this.http.get<User[]>(`${this.apiUrl}/users/`);
  }

  getLastTransaction() {
    return this.http.get(`${this.apiUrl}/transactions`);
  }

  getHistoricalTransactions() {
    return this.http.get(`${this.apiUrl}/transactions/historical`);
  }

  saveTransaction(transaction: any) {
    return this.http.post(`${this.apiUrl}/transactions/create`, transaction);
  }
}
