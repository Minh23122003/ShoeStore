import { Injectable } from '@angular/core';
import { Shoe } from './shoes.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Bill{
  id: number,
  quantity: number,
  size: number,
  payment_at: string,
  shoe: Shoe,
}

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private apiUrlBill = "http://localhost:8000/api/user/bills";
  private apiUrlPay = "http://localhost:8000/api/bills";
  private apiUrlRating = "http://localhost:8000/api/ratings";

  constructor(private http: HttpClient) { };

  getBills(): Observable<Bill[]>{
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem("token")}`
    })

    return this.http.get<Bill[]>(this.apiUrlBill, {headers: headers});
  }

  pay(id: number): Observable<any>{
    return this.http.post<any>(`${this.apiUrlPay}/${id}/pay`, {});
  }

  deleteBill(id: number): Observable<any>{
    return this.http.delete<any>(`${this.apiUrlPay}/${id}`, {})
  }

  getBillById(id: number): Observable<any>{
    return this.http.get<any>(`${this.apiUrlPay}/${id}`);
  }

  rating(formData: FormData): Observable<any>{
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem("token")}`
    })

    return this.http.post<any>(this.apiUrlRating, formData, {headers: headers});
  }
  
}
