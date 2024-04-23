import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { User } from './../../user';

import { ApiService } from './../../service/api.service';
import { leadingComment } from '@angular/compiler';

@Component({
  selector: 'app-users',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './users.component.html',
  styleUrl: './users.component.css'
})
export class UsersComponent implements OnInit {
  users: User[] = [];

  lastTransaction: any;

  historicalTransactions: any;

  transactions: any[] = [];

  user = {
    id: null,
    name: null,
    total: null,
  };

  constructor(private apiService: ApiService) { }

  ngOnInit() {
    this.getLastTransaction();

    this.getHistoricalTransactions();

    this.apiService.getAllUsers().subscribe({
      next: (users) => this.users = users,
      error: (error) => console.error(error),
    });
  }

  onSubmit(form: any) {
    if (form.valid) {
      const users = this.users;

      const values = form.value;

      const transactions = this.transactions;

      this.transactions = this.updateOrCreate(transactions, Object.assign(values, users.filter(user => user.id == values.id)[0]));

      form.reset();
    }
  }

  updateOrCreate(currentValues: any, newValues: any) {
    let exists = false;

    currentValues.forEach((user: any, index: any) => {
      if (user.id === newValues.id) {
        currentValues[index].total = newValues.total;
        exists = true;
      }
    });

    if (!exists) {
      currentValues.push(newValues);
    }

    return currentValues;
  }

  getLastTransaction() {
    this.apiService.getLastTransaction().subscribe({
      next: (transaction) => this.lastTransaction = transaction,
      error: (error) => console.error(error),
    });
  }

  getHistoricalTransactions() {
    this.apiService.getHistoricalTransactions().subscribe({
      next: (transactions) => this.historicalTransactions = transactions,
      error: (error) => console.error(error),
    });
  }

  deleteTransaction(name: string) {
    this.transactions = this.transactions.filter(transaction => transaction.name !== name);
  }

  saveTransactions() {
    this.apiService.saveTransaction({ transactions: this.transactions }).subscribe({
      next: (response) => {
        this.ngOnInit();

        this.transactions = []
      },
      error: (error) => console.error(error),
    });
  }
}
