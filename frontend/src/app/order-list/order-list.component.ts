import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { OrderResponse } from './order-response';
import { Order } from './order';
import { CancelResponse } from './cancel-response';
import moment from 'moment';
@Component({
  selector: 'order-list',
  templateUrl: './order-list.component.html',
  styleUrls: ['./order-list.component.css'],
})
export class OrderListComponent implements OnInit {
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
  currentPage = 1;

  config: any;

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
    const listUrl = 'http://localhost/api/order/get';

    return this.http.get<OrderResponse>(listUrl, {
      params: queryParams,
    });
  }

  getFormattedDate(date: string) {
    return moment(date).format('LLLL');
  }

  handlePageEvent(e: any) {
    this.getOrders(e.pageIndex + 1, e.pageSize).subscribe((data) => {
      const response = this.setResponseData(data);
      this.currentPage = e.pageIndex + 1;
      this.pageSize = e.pageSize;

      return response;
    });
  }

  setResponseData(data: OrderResponse) {
    this.response = data;
    this.columns = Object.keys(this.response.result.items[0]);
    this.items = this.response.result.items;
    this.lastPage = this.response.result.lastPage;
    this.total = this.response.result.total;
  }

  cancelOrderHandler(id: number) {
    const url = `http://localhost/api/order/${id}/cancel`;

    this.http.put<CancelResponse>(url, {});
    this.getOrders(`${this.currentPage + 1}`, `${this.pageSize}`);
  }
}
