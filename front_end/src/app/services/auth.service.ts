import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private urlApiLogin: string = "http://localhost:8000/api/login";
  private urlApiRegister: string = "http://localhost:8000/api/register";


  constructor(private http: HttpClient) { }

  login(formData: FormData): Observable<any>{
    return this.http.post<any>(this.urlApiLogin, formData);
  }

  register(formData: FormData): Observable<any>{
    return this.http.post<any>(this.urlApiRegister, formData);
  }

  isLogin(): boolean{
    return !!localStorage.getItem("token");
  }

  logout(): void{
    localStorage.removeItem("token");
  }
}
