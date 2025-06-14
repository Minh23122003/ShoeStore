import { Component, OnInit } from '@angular/core';
import { HomeComponent } from '../home/home.component';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Comment, Shoe, ShoesService } from '../services/shoes.service';
import { ActivatedRoute, Router } from '@angular/router';
import { HeaderComponent } from "../header/header.component";
import { AuthService, User } from '../services/auth.service';

@Component({
  selector: 'app-shoe-details',
  imports: [FormsModule, CommonModule, HeaderComponent],
  templateUrl: './shoe-details.component.html',
  styleUrl: './shoe-details.component.css'
})
export class ShoeDetailsComponent implements OnInit{
  shoe!: Shoe;
  shoeId: number = 0;
  comments: Comment[] = [];
  totalComments: number = 0;
  content: string = "";
  error: string = "";
  currentPage: number = 1;
  lastPage: number = 1;
  user: User | null = null;

  constructor(private shoesService: ShoesService, private route: ActivatedRoute, private router: Router, private authService: AuthService) {};

  ngOnInit(): void {
    if(typeof window !== "undefined"){
      this.shoeId = Number(this.route.snapshot.paramMap.get("id"));
      this.shoesService.getShoeById(this.shoeId).subscribe({
        next: (res) => {
          this.shoe = res;
        },
        error: (err) => {
          alert(err);
        }
      });

      this.authService.profile().subscribe({
        next: (res) => {
          this.user = res;
        },
        error: (err) => {
          alert(err);
        }
      })

      this.getComments(1);
    }
  }

  goToReserving(): void{
    this.router.navigate(["shoes", this.shoeId, "reserving"]);
  }

  postComment(): void{
    if(this.content == ""){
      this.error = "Vui lòng nhập nội dung bình luận!";
    }else if(localStorage.getItem("token") == null){
      this.error = "Vui lòng đăng nhập để bình luận!";
    }else{
      this.shoesService.postComment(this.shoeId, this.content).subscribe({
        next: (res) => {
          alert("Gửi bình luận thành công");
          this.getComments(1);
          this.content = "";
        },
        error: (err) => {
          alert(err);
        }
      })
    }
  }

  getMoreComments(): void{
    this.getComments(this.currentPage + 1);
  }

  getComments(page: number): void{
    this.shoesService.getComments(this.shoeId, page).subscribe({
      next: (res) => {
        if(page == 1){
          this.comments = res.data;
        }else{
          this.comments = [...this.comments, ...res.data];
        }
        this.totalComments = res.total;
        this.currentPage = res.current_page;
        this.lastPage = res.last_page;
      },
      error: (err) => {
        alert(err);
      }
    })
  }

  deleteComment(id: number){
    if(confirm("Bạn chắc chắn xóa?")){
      this.shoesService.deleteComment(id).subscribe({
        next: (res) => {
          alert("Xóa thành công!");
          this.getComments(1);
        },
        error: (err) => {
          alert(err);
        }
      })
    }
  }
}
