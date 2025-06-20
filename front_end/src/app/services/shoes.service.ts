import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable, numberAttribute } from '@angular/core';
import { Observable } from 'rxjs';
import { User } from './auth.service';

export interface Category{
  id: number,
  name: string
};

export interface Shoe{
  id: number,
  name: string,
  information: string,
  price: number,
  image: string,
  note: string,
  remaining_quantity: number
}

export interface Comment{
  id: number,
  content: string,
  created_at: string,
  user: User,
}

@Injectable({
  providedIn: 'root'
})
export class ShoesService {
  private urlApiCategory = "http://localhost:8000/api/categories";
  private urlApiShoe = "http://localhost:8000/api/shoes";
  private urlApiBill = "http://localhost:8000/api/bills";
  private urlApiComment = "http://localhost:8000/api/comments";


  constructor(private http: HttpClient) { }

  getCategories(): Observable<Category[]> {
    return this.http.get<Category[]>(this.urlApiCategory);
  }

  getShoes(category_id: number, name: string, price: number, page: number): Observable<any> {
    let params = new HttpParams();
    if(category_id != 0){
      params = params.set("category_id", category_id);
    }

    params = params.set("page", page);
    params = params.set("name", name);

    if(price == 1){
      params = params.set("max_price", 500000);
    }else if(price == 2){
      params = params.set("min_price", 500000);
      params = params.set("max_price", 3000000);
    }else if(price == 3){
      params = params.set("min_price", 3000000);
    }

    return this.http.get<any>(this.urlApiShoe, {params});
  }

  getShoeById(id: number): Observable<any>{
    return this.http.get<any>(`${this.urlApiShoe}/${id}`);
  }

  reserveShoe(formData: FormData): Observable<any>{
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem("token")}`
    })
    
    return this.http.post<any>(this.urlApiBill, formData, {headers: headers});
  }

  getComments(id: number, page: number): Observable<any>{
    let params = new HttpParams();
    params = params.set("page", page);

    return this.http.get<any>(`${this.urlApiShoe}/${id}/comments`, {params});
  }

  deleteComment(id: number): Observable<any>{
    return this.http.delete<any>(`${this.urlApiComment}/${id}`);
  }

  postComment(id: number, content: string): Observable<any>{
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem("token")}`
    })

    return this.http.post<any>(`${this.urlApiShoe}/${id}/comments`, {"content": content}, {headers: headers});
  }
}
