import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { OrderResponse } from './order-response';
import { Order } from './order';
import moment from 'moment';

@Component({
  selector: 'order-list',
  templateUrl: './order-list.component.html',
  styleUrls: ['./order-list.component.css'],
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

  selectedValue: number = 10;
  columns: string[] = [];
  items: Order[] = [];
  lastPage: number = 1;
  totalPages: object[] = [{ value: 1, viewValue: 1 }];

  total: number = 1;
  errors: string[] = [];

  pageSize = 10;
  pageSizeOptions = [10, 25, 100];

  showFirstLastButtons = true;

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
    this.getOrders().subscribe((data) => this.setResponseData(data));
  }

  getOrders(
    page: string = '1',
    noOfItems: string = '10'
  ): Observable<OrderResponse> {
    let queryParams = new HttpParams();
    queryParams = queryParams.append('page', page).append('items', noOfItems);

    return this.http.get<OrderResponse>(this.ordersUrl, {
      params: queryParams,
    });
  }

  getFormattedDate(date: string) {
    return moment(date).format('LLLL');
  }

  handlePageEvent(e: any) {
    console.log(e);
    this.getOrders(e.pageIndex + 1, e.pageSize).subscribe((data) =>
      this.setResponseData(data)
    );
  }

  setResponseData(data: OrderResponse) {
    this.response = data;
    this.columns = Object.keys(this.response.result.items[0]);
    this.items = this.response.result.items;
    this.lastPage = this.response.result.lastPage;
    this.total = this.response.result.total;
  }
}
