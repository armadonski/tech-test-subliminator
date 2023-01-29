import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/internal/Observable';
import { OrderResponse } from './order-response';
import { CancelResponse } from './cancel-response';

@Injectable()
export class DataService {
  constructor(private http: HttpClient) {}

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

  cancelOrder(id: any) {
    const url = `http://localhost/api/order/${id}/cancel`;

    this.http.put<CancelResponse>(url, {}).subscribe((data) => {
      console.log(data);
    });
  }
}
