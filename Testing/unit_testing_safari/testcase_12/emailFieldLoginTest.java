package testcase_12;

import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.safari.SafariDriver;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.Duration;

public class emailFieldLoginTest {
    WebDriver driver = null;

    @BeforeEach
    public void beforeAll(){
        driver = new SafariDriver();
        driver.navigate().to("https://badger-timeline.infinityfreeapp.com/public_html/views/pages/timeline");
    }

    @AfterEach
    public void aftertest(){
        driver.quit();
    }

    @Test
    public void test (){
        WebDriverWait wait = new WebDriverWait(driver, Duration.ofSeconds(5));
        WebElement element = driver.findElement(By.xpath("/html/body/div/div/div[1]/form/div[1]/input"));
        element.sendKeys("dakidfromakron@gmail.com");
    }

    public static void main (String[] args){

    }
}
