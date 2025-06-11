import { Component, OnInit } from '@angular/core';
import { HeaderComponent } from '../header/header.component';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Shoe, ShoesService } from '../services/shoes.service';

@Component({
  selector: 'app-reserving',
  imports: [HeaderComponent, CommonModule, FormsModule],
  templateUrl: './reserving.component.html',
  styleUrl: './reserving.component.css'
})
export class ReservingComponent implements OnInit{
  size: number = 35;
  quantity: number = 1;
  error: string = "";
  shoeId: number = 0;
  shoe!: Shoe;

  constructor(private route: ActivatedRoute, private shoeService:ShoesService, private router: Router) {};

  ngOnInit(): void {
    this.shoeId = Number(this.route.snapshot.paramMap.get("id"));
    this.shoeService.getShoeById(this.shoeId).subscribe({
      next: (res) => {
        this.shoe = res;
      },
      error: (err) => {
        alert(err);
      }
    });
  }

  reserving(): void{
    if(this.quantity == null){
      this.error = "Vui lòng nhập số lượng cần mua!";
    }else if(this.quantity > this.shoe.remaining_quantity){
      this.error = "Số lượng đặt phải ít hơn số lượng còn lại!";
    }else if(localStorage.getItem("token") == null){
      this.error = "Vui lòng đăng nhập để đặt hàng!";
    }else{
      let formData = new FormData();
      formData.append("quantity", String(this.quantity));
      formData.append("size" , String(this.size));
      formData.append("shoe_id", String(this.shoeId));

      this.shoeService.reserveShoe(formData).subscribe({
        next: (res) => {
          alert("Đặt mua thành công!");
          this.router.navigate([""]);
        },
        error: (err) => {
          console.log("Đặt hàng thất bại!");
        }
      })
    } 
  }
}
