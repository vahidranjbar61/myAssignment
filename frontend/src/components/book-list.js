
import { BookStatusType } from "../COMMON";
const BookList = ({ books, title, handleBooking }) => {

    return ( 
        <div className="book-list">
            <h2>{title}</h2>
            {
                books.map((book) => (
                    <div className="book-preview" key={book.id}>
                        <h2>{book.title}</h2>
                        <p>Author: {book.author}</p>
                        <p>Year: { book.date }</p>
                        {
                            book.status === BookStatusType.FREE 
                            ? <a className="book-status" onClick={() => handleBooking(book.id, BookStatusType.BORROW)}>Borrow this book</a>
                            : <a className="book-status" onClick={() => handleBooking(book.id, BookStatusType.FREE)}>Free this book</a>
                        }
                        <span className="book-status-icon">{book.status}</span>
                    </div> 
                ))
            }
        </div>
     );
}
 
export default BookList;