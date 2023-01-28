import { Component, NgModule, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { OrderResponse } from './order-response';
import { Order } from './order';
import moment from 'moment';

@Component({
  selector: 'order-list',
  templateUrl: './order-list.component.html',
})
export class OrderListComponent implements OnInit {
  private ordersUrl = 'http://localhost/api/order/get';

  response: OrderResponse = {
    result: {
      items: [],
      lastPage: 1,
      total: 1,
    },
    errors: [],
  };

  columns: string[] = [];
  items: Order[] = [];
  lastPage: number = 1;
  total: number = 1;
  errors: string[] = [];
  maxNoOfItems = [
    { value: 10, viewValue: 10 },
    { value: 20, viewValue: 20 },
    { value: 50, viewValue: 50 },
    { value: 100, viewValue: 100 },
  ];

  columnsToDisplay = [
    'id',
    'date',
    'customer',
    'address',
    'city',
    'postcode',
    'country',
    'amount',
    'status',
    'deleted',
    'last_modified',
    'actions',
  ];

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.getOrders().subscribe((data) => {
      this.response = data;
      this.columns = Object.keys(this.response.result.items[0]);
      this.items = this.response.result.items;
      this.lastPage = this.response.result.lastPage;
      this.total = this.response.result.total;
    });
  }

  getOrders(): Observable<OrderResponse> {
    return this.http.get<OrderResponse>(this.ordersUrl);
  }

  getFormattedDate(date: string) {
    return moment(date).format('LLLL');
  }
}
