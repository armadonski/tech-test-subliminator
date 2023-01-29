import { Component, OnInit } from '@angular/core';
import { OrderResponse } from './order-response';
import { Order } from './order';
import moment from 'moment';
import { DataService } from './DataService';
@Component({
  selector: 'order-list',
  templateUrl: './order-list.component.html',
  styleUrls: ['./order-list.component.css'],
  providers: [DataService],
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

  showFirstLastButtons = true;

  pageSize: string = '10';
  pageSizeOptions = [10, 25, 100];
  currentPage: string = '1';

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

  constructor(private dataService: DataService) {}

  ngOnInit(): void {
    this.dataService
      .getOrders()
      .subscribe((data) => this.setResponseData(data));
  }

  getFormattedDate(date: string) {
    return moment(date).format('LLLL');
  }

  handlePageEvent(e: any) {
    this.dataService
      .getOrders(e.pageIndex + 1, e.pageSize)
      .subscribe((data) => {
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

  handleCancelOrder(id: number) {
    this.dataService.cancelOrder(id);
    this.dataService
      .getOrders(this.currentPage, this.pageSize)
      .subscribe((data) => this.setResponseData(data));
  }
}
