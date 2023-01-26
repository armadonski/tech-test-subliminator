import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Order } from './order';

@Component({
  selector: 'order-list',
  templateUrl: './order-list.component.html',
})
export class OrderListComponent implements OnInit {
  private ordersUrl = 'http://localhost/api/get-orders?noOfItems=10&page=1';
  orders: Order[] = [];

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.getOrders().subscribe((data) => {
      this.orders = data;
    });
  }

  getOrders(): Observable<Order[]> {
    return this.http.get<Order[]>(this.ordersUrl);
  }
}
